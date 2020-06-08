// Get the container element
$(function(){
    var url = window.location.href; 

    $("#page-btn a").each(function(){
        if(url == (this.href)){
            $(this).closest("button").addClass("active")
        }
    })
}); 