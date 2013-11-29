var checkForm = function() {
    // clear error messages
    document.getElementById('errTitle').innerHTML = '';
    document.getElementById('errName').innerHTML = '';
    document.getElementById('errCity').innerHTML = '';
    document.getElementById('errZipcode').innerHTML = '';
    document.getElementById('errCard').innerHTML = '';
    document.getElementById('errCardnumber').innerHTML = '';
    document.getElementById('errExpirationdate').innerHTML = '';

    // check form
    var isValid = true;

    // title selected?
    if (document.getElementById('title').value == '-1') {
        document.getElementById('errTitle').innerHTML = 'selecteer een titel';
        isValid = false;
    }

    // name provided?
    if (document.getElementById('name').value == '') {
        document.getElementById('errName').innerHTML = 'geef een naam op';
        isValid = false;
    }

    // Street provided?
    if (document.getElementById('street').value == '') {
        document.getElementById('errStreet').innerHTML = 'geef een straat op';
        isValid = false;
    }

    // City provided?
    if (document.getElementById('city').value == '') {
        document.getElementById('errCity').innerHTML = 'geef een straat op';
        isValid = false;
    }

    // Postcode provided?
    if (document.getElementById('zipcode').value == '') {
        document.getElementById('errZipcode').innerHTML = 'geef een straat op';
        isValid = false;
    }

    // Postcode provided?
    if(!document.querySelectorAll('input[name="card"][type=radio]:checked').length > 0){
        document.getElementById('errCard').innerHTML = 'selecteer kaart op';
        isValid = false;
    }


    // check card number
    var rexCard = /^(\d{4})[-\/](\d{4})[-\/](\d{4})[-\/](\d{4})$/;
    if (!rexCard.test(document.getElementById('cardnumber').value)) {
        document.getElementById('errCardnumber').innerHTML = 'incorrect formaat';
        isValid = false;
    }
    // expiration date provided?
    if (document.getElementById('cardnumber').value == '') {
        document.getElementById('errCardnumber').innerHTML = 'geef een vervaldatum op';
        isValid = false;
    }

    // expiration date correct?
    var rexDate = /^(\d{2})[-\/](\d{2})[-\/](\d{4})$/;
    if (!rexDate.test(document.getElementById('expirationdate').value)) {
        document.getElementById('errExpirationdate').innerHTML = 'incorrect formaat';
        isValid = false;
    }
    // expiration date provided?
    if (document.getElementById('expirationdate').value == '') {
        document.getElementById('errExpirationdate').innerHTML = 'geef een vervaldatum op';
        isValid = false;
    }


    // return
    return isValid;
}

window.addEventListener('load', function() {
    document.getElementById('form1').addEventListener('submit', function(e) {
        e.preventDefault();
        if (checkForm()) this.submit();
    });
});