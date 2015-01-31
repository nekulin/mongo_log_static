$(document).ready(function() {
    $("#static").on('submit', function(){
        $.post($(this).attr('action'), $(this).serializeArray(), function(e){
            var html = '<h2>Result '+e.result.length+'</h2>';
            if (e.result.length>0) {
                for (i in e.result) {
                    html += "<div>" +
                    "   <p><b>Partner id</b>: "+ e.result[i]['_id']['partner_id']+"</p>" +
                    "   <p><b>Count</b>: "+ e.result[i]['count']+"</p>" +
                    "   <p><b>Unique Count</b>: "+ e.result[i]['ip_unique'].length+" ("+e.result[i]['ip_unique'].join(", ")+")</p>" +
                    "   <p><b>Date</b>: "+ e.result[i]['_id']['year']+"-"+ e.result[i]['_id']['month']+"-"+ e.result[i]['_id']['day']+" Hour "+ e.result[i]['_id']['hour']+"</p>" +
                    "</div><hr>";
                }
            }
            $("#results").html(html);
        }, 'json');
        return false;
    });
});