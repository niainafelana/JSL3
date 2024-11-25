<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>test</title>
</head>
<body>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" onchange="miova(this)" id="flexSwitchCheckChecked">
  <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" onchange="miova(this)" id="flexSwitchCheckChecked">
  <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" role="switch" onchange="miova(this)" id="flexSwitchCheckChecked">
  <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox input</label>
</div>

<script>
   
 function miova(id) {
    if (id.checked) {
        id.value=1;
    }else{
        id.value=0;
    }
    alert(id.value);
};
</script>
</body>
</html>