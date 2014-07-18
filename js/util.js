/* 
 *  funcoes genéricas
 * by: pls
 */

// alias para document.getElementById
function $_(obj){
    return document.getElementById(obj);
}
// isDataValida(string)>> valida data formato dd/mm/aaaa
function isDataValida(string){
    try{
        if (string.length < 10){
            return false;
        }else{
            var strData = new Array();
            strData = string.split("/");

            // patch pro bug do javascript
            if(strData[0] == "09" || strData[0] == "08"){strData[0] = "01";}
            if(strData[1] == "08"){strData[1] = "01";}
            if(strData[1] == "09"){strData[1] = "04";}
            //======

            if(strData.length != 3){return false;
            }else if(isNaN(strData[0]) || isNaN(strData[1]) || isNaN(strData[2])){return false;
            }else if(parseInt(strData[0]) > 29 && parseInt(strData[1]) == 2 ){return false;
            }else if(parseInt(strData[0]) > 31 || parseInt(strData[0]) <= 0 || strData[0].length != 2){return false;
            }else if(parseInt(strData[0]) == 31 && (parseInt(strData[1]) == 4 || parseInt(strData[1]) == 6 || parseInt(strData[1]) == 9 || parseInt(strData[1]) == 11) ){return false;
            }else if(parseInt(strData[1]) > 12 || parseInt(strData[1]) <= 0 || strData[1].length != 2){return false;
            }else if(parseInt(strData[2]) <= 0 || strData[2].length != 4 ){return false;
            }else{return true;}
        }
    }catch(err){
        alert(err.message);
        return false;
    }
}

// isDataValida(string)>> valida data formato hh:mm
function isHoraValida(string){
    try{
        if (string.length < 5){
            return false;
        }else{
            var arrData = new Array();
            arrData = string.split(":");
            if(arrData.length != 2){return false;
            }else if(isNaN(arrData[0]) || isNaN(arrData[1])){return false;
            }else if(parseInt(arrData[0]) < 0 || parseInt(arrData[0]) > 23 ){return false;
            }else if(parseInt(arrData[1]) < 0 || parseInt(arrData[1]) > 59){return false;
            }else{return true;}
        }
    }catch(err){
        alert(err.message);
        return false;
    }
}

//valida email
function isEmail( email ) {
    if (typeof(email) != "string") {
        return false;
    } else if (!email.match(/^[A-Za-z0-9]+([_.-][A-Za-z0-9]+)*@[A-Za-z0-9]+([_.-][A-Za-z0-9]+)*\.[A-Za-z0-9]{2,4}$/)) {
        return false;
    }else{
        return true;
    }
}

function replaceAll(source,stringToFind,stringToReplace){
    var temp = source;
    var index = temp.indexOf(stringToFind);
    while(index != -1){
        temp = temp.replace(stringToFind,stringToReplace);
        index = temp.indexOf(stringToFind);
    }
    return temp;
}
function number_format(number,decimals,dec_point,thousands_sep){number=(number+'').replace(/[^0-9+\-Ee.]/g,'');var n=!isFinite(+number)?0:+number,prec=!isFinite(+decimals)?0:Math.abs(decimals),sep=(typeof thousands_sep==='undefined')?',':thousands_sep,dec=(typeof dec_point==='undefined')?'.':dec_point,s='',toFixedFix=function(n,prec){var k=Math.pow(10,prec);return''+Math.round(n*k)/k;};s=(prec?toFixedFix(n,prec):''+Math.round(n)).split('.');if(s[0].length>3){s[0]=s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g,sep);}
if((s[1]||'').length<prec){s[1]=s[1]||'';s[1]+=new Array(prec-s[1].length+1).join('0');}
return s.join(dec);}

/**
 * gera um alert com a mensagem contida em msg
 */
function alertMsg() {
    if($('#msg')[0] && $('#msg').val() != ''){
        alert($('#msg').val());
        $('#msg').val('');
    }
}

function inativaEnter(tecla){
    if(tecla==13){
        return false;
    }
}