var printButtonPrepare = function() {
    var addPrintBefore = $('menuPrintBefore');
    var printButton = $('timetablePrintButton');
    if (!printButton && addPrintBefore) {
        var li = $(document.createElement('li'));
        var a = $(document.createElement('a'));
        li.appendChild(a);
        a.setAttribute('href', 'javascript:window.print();');
        a.setAttribute('id', 'timetablePrintButton');
        a.textContent = 'Tlačiť';
        //a.style.content = "\f02f";
        /*pseudoelemnty sa nedaju vkladat s javascriptom, iba skaredimi workaround-mi
         a na dynamicky generovane objekt css subor nevpliva :( */
        //a.pseudoStyle("before","content","\f02f");
        //a.textContent = " ";
        $(addPrintBefore.parentNode).insertBefore(li, addPrintBefore);
    }
}

var timetablePrepare = function() {
    var rozvrhList = $('rozvrhList');
    if (rozvrhList) {
        var d = $(document.createElement('div'));
        d.setAttribute('id','rozvrhListTogglerContainer');
        var chk = $(document.createElement('input'));
        chk.setAttribute('type', 'checkbox');
        chk.setAttribute('id', 'rozvrhListToggler');
        chk.addEvent('click', function() {
           var el = $('rozvrhList');
           if (chk.checked) {
               el.removeClass('hidden');
               Cookie.write("candle_timetable_list_show", "show", {});
           }
           else {
               el.addClass('hidden');
               Cookie.write("candle_timetable_list_show", "hide", {});
           }
        });
        var cookie1 = Cookie.read("candle_timetable_list_show");
        if ($chk(cookie1)) {
            var showList = (cookie1 == "show");
            chk.checked = showList;
            if (!showList) {
                rozvrhList.addClass('hidden');
            }
        }
        else {
            chk.checked = true;
        }
        d.appendChild(chk)
        var lab = $(document.createElement('label'));
        lab.setAttribute('for', 'rozvrhListToggler');
        lab.innerHTML = 'Zobrazova\u0165/tlačiť zoznam hodín';
        d.appendChild(lab);

        var chk2 = $(document.createElement('input'));
        chk2.setAttribute('type', 'checkbox');
        chk2.setAttribute('id', 'rozvrhListToggler2');
        chk2.addEvent('click', function() {
           var el2 = $('rozvrhList');
           if (chk2.checked) {
               el2.addClass('onNextPage');
               Cookie.write("candle_timetable_list_nextPage", "enabled", {});
           }
           else {
               el2.removeClass('onNextPage');
               Cookie.write("candle_timetable_list_nextPage", "disabled", {});
           }
        });
        var cookie2 = Cookie.read("candle_timetable_list_nextPage");
        if ($chk(cookie1)) {
            var showList2 = (cookie2 == "enabled");
            chk2.checked = showList2;
            if (showList2) {
                rozvrhList.addClass('onNextPage');
            }
        }
        else {
            chk2.checked = false;
        }
        d.appendChild(chk2)
        var lab2 = $(document.createElement('label'));
        lab2.setAttribute('for', 'rozvrhListToggler2');
        lab2.innerHTML = 'Tlačiť zoznam na ďaľšej strane';
        d.appendChild(lab2);
        rozvrhList.parentNode.insertBefore(d, rozvrhList)
    }

}

/*
skuska pre js => skarede
var arrangeTable = function() {

    var rows = document.getElementsByClassName('startTimeHeader');

    for (i = 0; i < rows.length; i++) {
        rows[i].style.backgroundColor = "red";
        var c=0; //start counting columns in row
        while(cell=rows[i].cells[c++]) {
            var offset = 4 + (200 * c)
            cell.style.right =  offset.toString();
        }
    }
}
window.addEvent('domready', arrangeTable);
*/

window.addEvent('domready', timetablePrepare);
window.addEvent('domready', printButtonPrepare);
