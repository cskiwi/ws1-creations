window.addEventListener('load', function() {

	// reeks 1
	document.getElementById('buttonA').addEventListener('click', function() {
		alert(document.getElementById('textfield1').value);
	});
	document.getElementById('buttonB').addEventListener('click', function() {
		document.getElementById('textfield1').value = 'hallo';
	});

    document.getElementById('buttonE').addEventListener('click', function() {
        document.getElementById('button1').disabled = true;
    });
    document.getElementById('buttonF').addEventListener('click', function() {
        document.getElementById('button1').onclick();
    });

    document.getElementById('buttonG').addEventListener('click', function() {
        document.getElementById('checkbox1').checked = true;
    });
    document.getElementById('buttonH').addEventListener('click', function() {
        document.getElementById('checkbox2').checked = !document.getElementById('checkbox2').checked;
    });

    document.getElementById('buttonI').addEventListener('click', function() {
        document.getElementById('select1').value = 'val2';
    });
    document.getElementById('buttonJ').addEventListener('click', function() {
        alert(document.getElementById('select1').options[document.getElementById('select1').selectedIndex].text);
    });

    // reeks 2
    document.getElementById('buttonK').addEventListener('click', function() {
       document.getElementById('cursus1').alt = 'cursus rietdekken';
    });
    document.getElementById('buttonL').addEventListener('click', function() {
        var tempVal = document.getElementById('cursus1').src;
        document.getElementById('cursus1').src = document.getElementById('cursus2').src;
        document.getElementById('cursus2').src = tempVal;

    });
    document.getElementById('buttonM').addEventListener('click', function() {
        document.getElementById('cursus1').width = 160;
    });

    // reeks 3
    document.getElementById('buttonN').addEventListener('click', function() {
        document.getElementById('layer1').innerHTML = 'dit is laats1';
    });
    document.getElementById('buttonO').addEventListener('click', function() {
        document.getElementById('place2').style.color = 'blue';
    });
    document.getElementById('buttonP').addEventListener('click', function() {
        document.getElementById('place1').className = 'errorMsg';
    });
    document.getElementById('buttonQ').addEventListener('click', function() {
        document.getElementById('layer2').style.visibility = 'hidden';
    });
    document.getElementById('buttonR').addEventListener('click', function() {
        divOne = document.getElementById('layer1');
        divTwo = document.getElementById('layer2');
        divThree = document.getElementById('layer3');
        container = divOne.parentNode;
        container.appendChild(divTwo);
        container.appendChild(divOne);
        container.appendChild(divThree);
    });
    document.getElementById('buttonS').addEventListener('click', function() {
        document.getElementById('layer1').style.top = 0;
        document.getElementById('layer2').style.top = 0;
        document.getElementById('layer3').style.top = 0;
    });
    // reeks 4
    document.getElementById('buttonT').addEventListener('click', function() {
        document.body.bgColor= 'grey';
    });
    document.getElementById('buttonU').addEventListener('click', function() {
        window.location.replace("http://google.com");
    });
    document.getElementById('buttonV').addEventListener('click', function() {
        document.title = 'testpagina';
    });
    document.getElementById('buttonW').addEventListener('click', function() {
        window.resizeTo(800,600);
    });
    document.getElementById('buttonX').addEventListener('click', function() {
        window.moveBy(50,0);
    });
    document.getElementById('buttonY').addEventListener('click', function() {
        if(confirm('Blauw?')){
            document.bgColor = 'Blue';
        }
    });
    document.getElementById('buttonZ').addEventListener('click', function() {
        var color = prompt("backgroundcolor","white");
        document.bgColor = color;
    });
    // reeks 5
    document.getElementById('buttonAA').addEventListener('click', function() {
        var titles = document.getElementsByTagName('h2');
        for(var i = 0; i < titles.length;i++)
            titles[i].style.color = 'green';
    });
    document.getElementById('buttonAB').addEventListener('click', function() {
        alert(document.querySelectorAll('#form1 input[type=button]').length);
    });
    document.getElementById('buttonAC').addEventListener('click', function() {
        if(!this.text) this.text = prompt('geef text');
        else alert(this.text);
    });

});