function creForm(i) {
    button = document.getElementById("cre"+i);
    button.removeAttribute("style");
    button.setAttribute("style", "display: block");
    
    // var f = document.createElement("form");
    // f.setAttribute('method',"post");
    // f.setAttribute('action',"index.php?ctl=comments&act=addcmt&path_id="+path_id);

    // var i = document.createElement("input"); //input element, text
    // i.setAttribute('type',"text");
    // i.setAttribute('name',"content");

    // var s = document.createElement("input"); //input element, Submit button
    // s.setAttribute('name',"btn_submit");
    // s.setAttribute('type',"submit");
    // s.setAttribute('value',"Submit");

    // f.appendChild(i);
    // f.appendChild(s);

    // //and some more input elements here
    // //and dont forget to add a submit button
    // console.log('cre'+stt); //goi dc
    // document.getElementById('cre'+stt).appendChild(f);
    
}