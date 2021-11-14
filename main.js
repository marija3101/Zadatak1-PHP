//dodavanje kursa
//pristup preko id-ja
$('#dodajForm').submit(function() {
    event.preventDefault();
    //serijalizacija
    const $forma =$(this);
    const $polja = $forma.find('input, select, button');
    const serijalizacija = $forma.serialize();
    console.log(serijalizacija);
    $polja.prop('disabled', true);

//slanje zahteva
zahtev = $.ajax ({
    url: 'pozivanjeFja/dodaj.php',
    type: 'post',
    data: serijalizacija
});
//provera zahteva
zahtev.done(function(res, textStatus, jqXHR) {
if(res == "Success") {
alert("Kurs je dodat");
location.reload(true);
} else {
    console.log("Kurs nije dodat"+res);
}
});

zahtev.fail(function(jqXAR, textStatus, errorThrown) {
console.log('Greska'+textStatus,errorThrown)
});
});


//brisanje kursa
//pristup preko klase jer imamo vise obrisi buttona
$('.obrisi').click(function(){

    //pristup id-ju putem imena
    const oznacene = $('input[name=cekirano]:checked');
    //slanje zahteva
    zahtev = $.ajax({
        url: 'pozivanjeFja/izbrisi.php',
        type:'post',
        data: {'id':oznacene.val()}
    });
    //provera zahteva
    zahtev.done(function(res, textStatus, jqXHR){
        if(res=="Success"){
           oznacene.closest('tr').remove();
           alert('Izbrisan kurs');
        }else {
        console.log("Kurs nije izbrisan "+res);
        alert("Kurs nije izbrisan");

        }
    });
    zahtev.fail(function(jqXAR, textStatus, errorThrown) {
        console.log('Greska'+textStatus,errorThrown)
        });

});

//popunjavanje modula za izmenu
//takodje pristup preko klase jer imamo vise uredi buttona
$('.urediti').click(function(){
    //pristup id-ju putem imena
    const oznacene = $('input[name=cekirano]:checked');
    //slanje zahteva
    zahtev = $.ajax({
        url: 'pozivanjeFja/get.php',
        type:'post',
        dataType : "json",
        data: {'id': oznacene.val()}
    });
    //provera zahteva
    zahtev.done(function(res, textStatus, jqXHR){
        console.log('Popunjena');
        $('#jezik').val(res[0]['jezik']);
        console.log(res[0]['jezik']);

        $('#broj').val(res[0]['broj'].trim());
        console.log(res[0]['broj'].trim());

        $('#date').val(res[0]['date'].trim());
        console.log(res[0]['date'].trim());

        $('#id').val(oznacene.val());

        console.log(res);
    });
    zahtev.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Greska' + textStatus, errorThrown);
    });

});

//izmena kursa
$('#urediForm').submit(function () {
    event.preventDefault();
    //serijalizacija
    console.log("Izmene");
    const $forma = $(this);
    const $polja = $forma.find('input, select, button');
    const serijalizacija = $forma.serialize();
    console.log(serijalizacija);
    $polja.prop('disabled', true);
    //slanje zahteva
    zahtev = $.ajax({
        url: 'pozivanjeFja/azuriraj.php',
        type: 'post',
        data: serijalizacija
      
    });
   //provera zahteva
     zahtev.done(function(res, textStatus, jqXHR) {
       
          if (res =="Success") {
                console.log('Kurs je azuriran');
                alert('Kurs je azuriran');
                location.reload(true);
                $('#urediForm').reset;
            }
            else  {
            alert('Kurs nije azuriran');
        }
            console.log(res);
        });
    

    zahtev.fail(function (jqXHR, textStatus, errorThrown) {
        console.error('Greska' + textStatus, errorThrown);
    });


    $('#uredi').modal('hide'); //sakrivamo modal nakon izvrsenog zahteva
});

