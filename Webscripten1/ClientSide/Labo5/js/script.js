/**
 * Created by Glenn on 12/16/13.
 */


var numAll = 0, numFamily = 0, numFriend = 0,numColl = 0,numOther = 0;
updateNumbers();

$('#txtSearch').keyup(function(){
    var $this = $(this), val = $this.val().toLowerCase();

    if (val === '') {
        $('article.contact').show();
    } else {
        $('article.contact').hide()
            .find('.searchstring:contains("'+ val +'")')
            .parent().show();
    }

    updateNumbers();
});

function updateNumbers(){
    numAll = 0, numFamily = 0, numFriend = 0,numColl = 0,numOther = 0;
    $('article.contact:visible').each(function(){
        numAll +=1;
        if ($(this).hasClass('family')) numFamily++
        if ($(this).hasClass('friend')) numFriend++
        if ($(this).hasClass('colleague')) numColl++
        if ($(this).hasClass('other')) numOther++
    });
    $('#numAll').text(numAll);
    $('#numFamily').text(numFamily);
    $('#numFriends').text(numFriend);
    $('#numColleagues').text(numColl);
    $('#numOther').text(numOther);
}

$('article a').click(function(){
    var article = $(this).closest('article');
    var contactId = article.attr('id').replace('contact_', '');
    switch ($(this).text()){
        case 'verwijderen':
            if(confirm('zeker?')){
                $.get( 'includes/api.php', { id : contactId, action : "delete" });
            }
            break;
        case 'bewerken':
            if(confirm('zeker?'))
                console.log('Delete, id: ' + id);
            break;
        default :
            break;
    }
});
$(document).ready(function () {
    $.get( "api.php", { name: "John", time: "2pm" } );
});
console.log('eof')
