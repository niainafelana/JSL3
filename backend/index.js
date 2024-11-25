const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const cors = require('cors');
const { format } = require('date-fns');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());
app.use(cors({
    methods: ['GET', 'POST']
}));
 // Active CORS pour toutes les routes

// Connexion à MySQL
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'sre'
});

connection.connect((err) => {
    if (err) {
        console.error('Error connecting to MySQL: ' + err.stack);
        return;
    }
    console.log('Connected to MySQL as id ' + connection.threadId);
});

// Route de connexion
// Route de connexion
// Route de connexion

//log in
app.post('/login', (req, res) => {
    const { username, password } = req.body;
    const query = 'SELECT * FROM administrateur WHERE username = ? ';
    connection.query(query, [username, password], (error, results, fields) => {
        if (error) {
            console.error('Error executing MySQL query: ' + error.stack);
            res.status(500).send('tsy mety');
            return;
        }

        if (results.length > 0) {
            res.status(200).json({
                message: 'ok',
                status_code: 201
            });
        } else {
            res.status(401).send('false');

        }
    });
});

/*
app.post('/login', (req, res) => {
    const { username, password } = req.body;
    // Sélectionnez l'utilisateur en fonction du nom d'utilisateur, pas du mot de passe
    connection.query('SELECT * FROM administrateur WHERE username = ?', [username], (error, results) => {
      if (error) {
        // Gérer les erreurs de requête SQL
        console.error("Error querying database:", error);
        res.status(500).json({ message: 'Internal server error' });
        return;
      }
      if (results.length > 0) {
        const user = results[0];
        // Comparer le mot de passe entré avec le mot de passe hashé stocké en base de données
        bcrypt.compare(password, user.password, (err, result) => {
          if (err) {
            // Gérer les erreurs de hachage
            console.error("Error comparing passwords:", err);
            res.status(500).json({ message: 'Internal server error' });
            return;
          }
          if (result) {
            res.json({ message: 'Login successful' });
          } else {
            res.status(401).json({ message: 'Invalid credentials' });
          }
        });
      } else {
        res.status(404).json({ message: 'User not found' });
      }
    });
  });
  
  
*/
//recuperation des donnes(raison et adresse) a partir du nif
app.get('/data', (req, res) => {
    const nif = req.query.nif; // Récupérer le paramètre NIF à partir de la requête GET
    const query = 'SELECT raison, adrs FROM contribuable WHERE nif = ?';
    connection.query(query, [nif], (error, results, fields) => {
        if (error) {
            console.error('Error executing MySQL query: ' + error.stack);
            res.status(500).send('Internal Server Error');
            return;
        }
        res.json(results);
    });
});


//ajouter paiment par caisse(cheque ou espèce)
app.post('/paiement', (req, res) => {
    const { nif, montant, mode } = req.body;
    const code = '006';
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const day = String(currentDate.getDate()).padStart(2, '0');
    const datepaie = `${year}-${month}-${day}`; // Date actuelle au format YYYY-MM-DD
    // Insertion des données dans la base de données
    const query = 'INSERT INTO paiement (nif, code,mode,montant, datepaie) VALUES (?, ?, ?, ?, ?)';
    connection.query(query, [nif, code, mode, montant, datepaie], (err, result) => {
      if (err) {
        console.error('Erreur lors de l\'ajout des données :', err);
        res.status(500).send('Erreur lors de l\'ajout des données');
        return;
      }
      console.log('Données ajoutées avec succès !');
      res.status(200).send('Données ajoutées avec succès');
    });
  });

  app.get('/dashboard', (req, res) => {
    const query = 'SELECT * FROM transfert';
    connection.query(query, (error, results) => {
        if (error) {
            console.error('Erreur lors de la récupération des données:', error.stack);
            return res.status(500).json({ error: 'Erreur serveur' });
        }
        res.json(results);
        console.log(results);
    });
});
   







app.post('/virement', (req, res) => {
    const { nif,raison,banque, montant,date1,date2,ref } = req.body;
    const code = '006';
    const query = 'INSERT INTO virement (ref, nif, sociale, banky, vola, datevaleur) VALUES (?, ?, ?, ?, ?, ?); INSERT INTO recevoir (code, ref, dateregle) VALUES (?, ?, ?)';
    connection.query(query, [ref, nif, raison, banque, montant, date1], [code, ref, date2], (err, result) => {
        if (err) {
            console.error('Erreur lors de l\'ajout des données :', err);
            res.status(500).send('Erreur lors de l\'ajout des données');
            return;
          }
          console.log('Données ajoutées avec succès !');
          res.status(200).send('Données ajoutées avec succès');
        });
      });
    

// Route pour gérer les bordereaux
app.post('/bordereau', (req, res) => {
  const { deb, fin, emt, dest, tp } = req.body;
  const code = "006";
  const codeser = "010";

  let tot;

  const excludeTypes = ['num', 'vir', 'che'];

  const getTotalQuery = (tp) => {
    return `SELECT SUM(som) as total FROM transfert WHERE typ = ? AND typ NOT IN (${excludeTypes.map(() => '?').join(', ')})`;
  };

  const getSumQuery = (tp) => {
    return `SELECT SUM(som) as mon FROM transfert WHERE typ = ? AND typ NOT IN (${excludeTypes.map(() => '?').join(', ')}) AND (datedeb BETWEEN ? AND ?)`;
  };

  const queries = {
    'Espèce': getTotalQuery('Espèce'),
    'Chèque': getTotalQuery('Chèque'),
    'Virement': getTotalQuery('Virement')
  };

  const sums = {
    'Espèce': getSumQuery('Espèce'),
    'Chèque': getSumQuery('Chèque'),
    'Virement': getSumQuery('Virement')
  };

  const executeQuery = (query, params) => {
    return new Promise((resolve, reject) => {
      connection.query(query, params, (error, results) => {
        if (error) {
          return reject(error);
        }
        resolve(results[0].total || 0);
      });
    });
  };

  const insertData = (som) => {
    return new Promise((resolve, reject) => {
      const insertQuery = "INSERT INTO transfert VALUES (null, ?, ?, ?, ?, ?, ?)";
      connection.query(insertQuery, [code, codeser, tp, deb, fin, som], (error, result) => {
        if (error) {
          return reject(error);
        }
        resolve(result);
      });
    });
  };

  if (['Espèce', 'Chèque', 'Virement'].includes(tp)) {
    Promise.all([
      executeQuery(queries[tp], [tp, ...excludeTypes]),
      executeQuery(sums[tp], [tp, ...excludeTypes, deb, fin])
    ]).then(([total, som]) => {
      return insertData(som).then(() => {
        res.json({ 'tot': total, 'tp': tp, 'som': som });
      });
    }).catch(error => {
      console.error('Erreur lors de l\'exécution des requêtes:', error.stack);
      res.status(500).json({ error: 'Erreur serveur' });
    });
  } else {
    res.status(400).json({ error: 'Type de transaction non supporté' });
  }
});



// Démarrage du serveur
app.listen(PORT, () => {
    console.log(`Server running on port ${PORT}`);
});
