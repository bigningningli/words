function submit() {
    disp();
    var cont=document.getElementById('words').value;
    var ajax=new XMLHttpRequest();
    ajax.open("get","receive.php?words="+cont,false);
    ajax.onload=function () {

        if(ajax.responseText.indexOf("~")<0){
            alert(ajax.responseText);
        }else {


            var strarr = ajax.responseText.split("~", 6);

            document.getElementById('title').innerHTML = strarr[0];

            document.getElementById('content').innerHTML =
                '过去式:<br>' + strarr[1] + '<br>' +
                '过去分词:<br>' + strarr[2] + '<br>' +
                '现在分词:<br>' + strarr[3] + '<br>' +
                '复数:<br>' + strarr[4] + '<br>' +
                '联想:<br>' + strarr[5] + '<br>'
            ;

        }
    }

    ajax.send(null);
}
function disp() {
    document.getElementById('main').style.display="block";
}