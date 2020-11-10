$(".btn-danger").click(function() {
    if ( ! confirm ( 'Confirma?' ) )
        return false;                           
}); 

function getFormattedDate(data) {
    date = new Date(data)
    let year = date.getFullYear();
    let month = (1 + date.getMonth()).toString().padStart(2, '0');
    let day = date.getDate().toString().padStart(2, '0');
  
    return month + '/' + day + '/' + year;
}

