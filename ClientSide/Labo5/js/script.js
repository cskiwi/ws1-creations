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
    var id = article.attr('id').replace('contact_', '');
    switch ($(this).text()){
        case 'verwijderen':
            if(confirm('zeker?')){
                $.ajax({
                    url: 'includes/api.php',
                    type: 'get',
                    // dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data, textStatus, jqXHR) {
                        console.log('success');
                        console.log(id);
                        // article.hide();
                    },
                    error : function(jqXHR, textStatus, errorThrown) {
                        console.log('error');
                    }
                });
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

