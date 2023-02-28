// ===============================================================================================
// Permitir o retorno(voltar) no navegador, após erro no formulário;
if (window.history.replaceState){
    window.history.replaceState(null, null, window.location.href);
}
// ===============================================================================================
//Calcular a foça da senha
function passwordStrength(){
    var password = document.getElementById('password').value;
    var strength = 0;
    if ((password.length >= 6) && (password.length <= 7)){
        strength += 10;
    } else if (password.length > 7){
        strength += 25;
    }
    if ((password.length >= 6) && (password.match(/[a-z]+/))){
        strength += 10;
    }
    if ((password.length >= 7) && (password.match(/[A-Z]+/))){
        strength += 20;
    }
    if ((password.length >= 8 ) && (password.match(/[@#$%;!*]+/))){
        strength += 25;
    }
    if (password.match(/([1-9]+)\1{1,}/)){
        strength -= 25;
    }
    viewStrength(strength);
}
// ================================================================================================
function viewStrength(strength){
    // Imprimir a força da senha
    if(strength < 30){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert alert-danger'>Senha Fraca(JS)</p>";
    } else if ((strength >= 30) && (strength < 50)){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert alert-warning'>Senha Média(JS)</p>";
    } else if ((strength >= 50) && (strength < 70)){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert alert-primary'>Senha Boa(JS)</p>";
    } else if (strength >= 70){
        document.getElementById("msgViewStrength").innerHTML = "<p class='alert alert-success'>Senha Forte(JS)</p>";
    } else {
        document.getElementById("msgViewStrength").innerHTML = "";
    }
}
// ================================================================================================
