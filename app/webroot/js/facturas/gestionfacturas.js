function imprimirTicket(){
    //remover las clases hidden y visible de los div necesarios    
    $("#divImg").removeClass("visible-print");
    $("#divTable").removeClass("visible-print");
    $("#divTableTicket").removeClass("hidden-print");
    
    //agregar las clases visible y hidden de los div necesarios    
    $("#divImg").addClass("hidden-print");
    $("#divTable").addClass("hidden-print");
    $("#divTableTicket").addClass("visible-print");
    
    window.print();
}

function imprimirFactura(){
    //remover las clases hidden y visible de los div necesarios    
    $("#divImg").removeClass("hidden-print");
    $("#divTable").removeClass("hidden-print");
    $("#divTableTicket").removeClass("visible-print");
    
    //agregar las clases visible y hidden de los div necesarios       
    $("#divImg").addClass("visible-print");
    $("#divTable").addClass("visible-print");
    $("#divTableTicket").addClass("hidden-print");
    
    window.print();
}