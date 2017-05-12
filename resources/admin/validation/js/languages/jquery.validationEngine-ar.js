/*****************************************************************
 * Arabic language file for jquery.validationEngine.js (ver2.6.x)
 *
 * Transrator: @yasser_lotfy ( Yasser Lotfy )
 * http://be.net/YasserLotfy
 * Licenced under the MIT Licence
 *******************************************************************/
(function($){
    $.fn.validationEngineLanguage = function(){
    };
    $.validationEngineLanguage = {
        newLang: function(){
            $.validationEngineLanguage.allRules = {
                "required": { // Add your regex rules here, you can take telephone as an example
                    "regex": "none",
                    "alertText": "* هذا الحقل مطلوب",
                    "alertTextCheckboxMultiple": "* برجاء إختيار إحدى الخيارات",
                    "alertTextCheckboxe": "* هذا المربع الإختياري مطلوب",
                    "alertTextDateRange": "* كلا حقلين نطاق التاريخ مطلوبة"
                },
                "requiredInFunction": { 
                    "func": function(field, rules, i, options){
                        return (field.val() == "test") ? true : false;
                    },
                    "alertText": "* الحقل يجب أن يساوى test"
                },
                "dateRange": {
                    "regex": "none",
                    "alertText": "* غير صالح ",
                    "alertText2": "نطاق التاريخ"
                },
                "dateTimeRange": {
                    "regex": "none",
                    "alertText": "* غير صالح ",
                    "alertText2": "نطاق التاريخ والوقت"
                },
                "minSize": {
                    "regex": "none",
                    "alertText": "* على الأقل ",
                    "alertText2": " حروف مطلوبة"
                },
                "maxSize": {
                    "regex": "none",
                    "alertText": "* على الأكثر ",
                    "alertText2": " حروف مسموحة"
                },
				"groupRequired": {
                    "regex": "none",
                    "alertText": "* يجب عليك ملئ إحدى الحقول التالية",
                    "alertTextCheckboxMultiple": "* برجاء إختيار إحدى الخيارات",
                    "alertTextCheckboxe": "* هذا المربع الإختياري مطلوب"
                },
                "min": {
                    "regex": "none",
                    "alertText": "* الحد الأدنى للقيمة هو "
                },
                "max": {
                    "regex": "none",
                    "alertText": "* الحد الأقصى للقيمة هو "
                },
                "past": {
                    "regex": "none",
                    "alertText": "* التاريخ قبل "
                },
                "future": {
                    "regex": "none",
                    "alertText": "* التاريخ بعد "
                },	
                "maxCheckbox": {
                    "regex": "none",
                    "alertText": "* على الأكثر ",
                    "alertText2": " خيارات مسموحة"
                },
                "minCheckbox": {
                    "regex": "none",
                    "alertText": "* برجاء إختيار ",
                    "alertText2": " خيارات"
                },
                "equals": {
                    "regex": "none",
                    "alertText": "* الحقول غير متساوية"
                },
                "creditCard": {
                    "regex": "none",
                    "alertText": "* رقم بطاقة الإتمان غير صالح"
                },
                "phone": {
                    // credit: jquery.h5validate.js / orefalo
                    "regex": /^([\+][0-9]{1,3}([ \.\-])?)?([\(][0-9]{1,6}[\)])?([0-9 \.\-]{1,32})(([A-Za-z \:]{1,11})?[0-9]{1,4}?)$/,
                    "alertText": "* رقم الهاتف غير صالح"
                },
                "email": {
                    // HTML5 compatible email regex ( http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#    e-mail-state-%28type=email%29 )
                    "regex": /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
                    "alertText": "* عنوان بريد إلكتروني غير صالح"
                },
                "fullname": {
                    "regex":/^([a-zA-Z]+[\'\,\.\-]?[a-zA-Z ]*)+[ ]([a-zA-Z]+[\'\,\.\-]?[a-zA-Z ]+)+$/,
                    "alertText":"* يجب أن يكون الإسم الأول والأخير"
                },
                "zip": {
                    "regex":/^\d{5}$|^\d{5}-\d{4}$/,
                    "alertText":"* صيغة الرمز البريدي غير صالحة"
                },
                "integer": {
                    "regex": /^[\-\+]?\d+$/,
                    "alertText": "* هذا ليس عدد صحيح صالح"
                },
                "number": {
                    // Number, including positive, negative, and floating decimal. credit: orefalo
                    "regex": /^[\-\+]?((([0-9]{1,3})([,][0-9]{3})*)|([0-9]+))?([\.]([0-9]+))?$/,
                    "alertText": "* عدد عشري غير صالح"
                },
                "date": {                    
                    //	Check if date is valid by leap year
			"func": function (field) {
					var pattern = new RegExp(/^(\d{4})[\/\-\.](0?[1-9]|1[012])[\/\-\.](0?[1-9]|[12][0-9]|3[01])$/);
					var match = pattern.exec(field.val());
					if (match == null)
					   return false;
	
					var year = match[1];
					var month = match[2]*1;
					var day = match[3]*1;					
					var date = new Date(year, month - 1, day); // because months starts from 0.
	
					return (date.getFullYear() == year && date.getMonth() == (month - 1) && date.getDate() == day);
				},                		
			 "alertText": "* تاريخ غير صالح، يجب أن يكون في هيئة YYYY-MM-DD"
                },
                 "hijridate": {                    
                    //	Check if date is valid by leap year
			"func": function (field) {
					var pattern2 = new RegExp(/^(0?[1-9]|[12][0-9]|3[01])[\/\-\.](0?[1-9]|1[012])[\/\-\.](\d{4})$/);
					var match2 = pattern2.exec(field.val());
					if (match2 == null)
					   return false;
	
					var hyear = match2[1];
					var hmonth = match2[2]*1;
					var hday = match2[3]*1;					
					//var date = new Date(year, month - 1, day); // because months starts from 0.
	
					return (hday - hmonth - hyear);
				}, 
                    "alertText": "* تاريخ غير صالح، يجب أن يكون في هيئة YYYY-MM-DD"
                },  
                "ipv4": {
                    "regex": /^((([01]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))[.]){3}(([0-1]?[0-9]{1,2})|(2[0-4][0-9])|(25[0-5]))$/,
                    "alertText": "* عنوان IP غير صالح"
                },
                "url": {
                    "regex": /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i,
                    "alertText": "* عنوان إلكتروني غير صالح"
                },
                "onlyNumberSp": {
                    "regex": /^[0-9\ ]+$/,
                    "alertText": "* أرقام فقط"
                },
                "onlyLetterSp": {
                    "regex": /^[a-zA-Z\ \']+$/,
                    "alertText": "* حروف فقط"
                },
                "onlyLetterAccentSp": {
                    "regex": /^[a-z\u00C0-\u017F\ ]+$/i,
                    "alertText": "* حروف فقط (مسموح بالنبرات)"
                },
                "onlyLetterNumber": {
                    "regex": /^[0-9a-zA-Z]+$/,
                    "alertText": "* غير مسموح بحروف خاصة"
                },
                 "carLicenses": {
                    "regex": /^([\u0600-\u064A\u066E-\u06D5a-zA-Z]{1})+[ ]+([\u0600-\u064A\u066E-\u06D5a-zA-Z]{1})+[ ]+([\u0600-\u064A\u066E-\u06D5a-zA-Z]{1})$/,
                    "alertText": "* 3 حروف وما بينهم مسافات "
                },
                // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxUserCall": {
                    "url": "ajaxValidateFieldUser",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    "alertText": "* هذا المستخدم بالفعل موجود",
                    "alertTextLoad": "* جاري التحقق، برجاء الإنتظار"
                },
                // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxNetworkCall": {
                    "url": "../check_network",
                    // you may want to pass extra data on the ajax call
                  //  "extraData": "name",
                    "alertText": "* هذا الأسم موجود من قبل",
                    "alertTextLoad": "* جارى التحقق من اسم الشبكة برجاء الانتظار"
                },
                 // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxNetworkCall2": {
                    "url": "check_network",
                    // you may want to pass extra data on the ajax call
                  //  "extraData": "name",
                    "alertText": "* هذا الأسم موجود من قبل",
                    "alertTextLoad": "* جارى التحقق من اسم الشبكة برجاء الانتظار"
                },
                 // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxSeqCall": {
                    "url": "../check_Seq",
                    // you may want to pass extra data on the ajax call
                  //  "extraData": "name",
                    "alertText": "* هذا الرقم التسلسلى موجود من قبل",
                    "alertTextLoad": "* جارى التحقق من الرقم التسلسلى برجاء الانتظار"
                }, 
                 // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxSeqCall2": {
                    "url": "check_Seq",
                    // you may want to pass extra data on the ajax call
                  //  "extraData": "name",
                    "alertText": "* هذا الرقم التسلسلى موجود من قبل",
                    "alertTextLoad": "* جارى التحقق من الرقم التسلسلى برجاء الانتظار"
                }, 
                 // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxIDCall": {
                    "url": "../checkID",
                    // you may want to pass extra data on the ajax call
                  //  "extraData": "name",
                    "alertText": "* هذا الرقم التعريفى موجود من قبل",
                    "alertTextLoad": "* جارى التحقق من الرقم التعريفى برجاء الانتظار"
                }, 
                 // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxIDCall2": {
                    "url": "checkID",
                    // you may want to pass extra data on the ajax call
                  //  "extraData": "name",
                    "alertText": "* هذا الرقم التعريفى موجود من قبل",
                    "alertTextLoad": "* جارى التحقق من الرقم التعريفى برجاء الانتظار"
                }, 
                // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxMobCall": {
                    "url": "../checkMobile",
                    // you may want to pass extra data on the ajax call
                  //  "extraData": "name",
                    "alertText": "* رقم الجوال موجود من قبل",
                    "alertTextLoad": "* جارى التحقق من رقم الجوال برجاء الانتظار"
                }, 
                "ajaxMobCall2": {
                    "url": "checkMobile",
                    // you may want to pass extra data on the ajax call
                  //  "extraData": "name",
                   "alertText": "* رقم الجوال موجود من قبل",
                    "alertTextLoad": "* جارى التحقق من رقم الجوال برجاء الانتظار"
                }, 
                // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxCodeCall": {
                    "url": "../checkCode",
                    // you may want to pass extra data on the ajax call
                  //  "extraData": "name",
                    "alertText": "* هذا الكود موجود من قبل",
                    "alertTextLoad": "* جارى التحقق من الكود برجاء الانتظار"
                },
                 // --- CUSTOM RULES -- Those are specific to the demos, they can be removed or changed to your likings
                "ajaxCodeCall2": {
                    "url": "checkCode",
                    // you may want to pass extra data on the ajax call
                  //  "extraData": "name",
                    "alertText": "* هذا الكود موجود من قبل",
                    "alertTextLoad": "* جارى التحقق من الكود برجاء الانتظار"
                },
                "ajaxUserEmail":{
                   "url": "../checkUserEmail",
                    // you may want to pass extra data on the ajax call
                  //  "extraData": "name",
                    "alertText": "* هذا البريد الالكتروني موجود من قبل",
                    "alertTextLoad": "* جارى التحقق من البريد الالكتروني برجاء الانتظار"  
                },
                "ajaxUserEmail2":{
                   "url": "checkUserEmail",
                    // you may want to pass extra data on the ajax call
                  //  "extraData": "name",
                    "alertText": "* هذا البريد الالكتروني موجود من قبل",
                    "alertTextLoad": "* جارى التحقق من البريد الالكتروني برجاء الانتظار"  
                },
				"ajaxUserCallPhp": {
                    "url": "phpajax/ajaxValidateFieldUser.php",
                    // you may want to pass extra data on the ajax call
                    "extraData": "name=eric",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* إسم المستخدم هذا متاح",
                    "alertText": "* هذا المستخدم بالفعل موجود",
                    "alertTextLoad": "* جاري التحقق، برجاء الإنتظار"
                },
                "ajaxNameCall": {
                    // remote json service location
                    "url": "ajaxValidateFieldName",
                    // error
                    "alertText": "* هذا الإسم موجود بالفعل",
                    // if you provide an "alertTextOk", it will show as a green prompt when the field validates
                    "alertTextOk": "* هذا الإسم متاح",
                    // speaks by itself
                    "alertTextLoad": "* جاري التحقق، برجاء الإنتظار"
                },
				 "ajaxNameCallPhp": {
	                    // remote json service location
	                    "url": "phpajax/ajaxValidateFieldName.php",
	                    // error
	                    "alertText": "* هذا الإسم موجود بالفعل",
	                    // speaks by itself
	                    "alertTextLoad": "* جاري التحقق، برجاء الإنتظار"
	                },
                "validate2fields": {
                    "alertText": "* برجاء إدخال HELLO"
                },
	            //tls warning:homegrown not fielded 
                "dateFormat":{
                    "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(?:(?:0?[1-9]|1[0-2])(\/|-)(?:0?[1-9]|1\d|2[0-8]))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^(0?2(\/|-)29)(\/|-)(?:(?:0[48]00|[13579][26]00|[2468][048]00)|(?:\d\d)?(?:0[48]|[2468][048]|[13579][26]))$/,
                    "alertText": "* تاريخ غير صالح"
                },
                //tls warning:homegrown not fielded 
				"dateTimeFormat": {
	                "regex": /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1}$|^(?:(?:(?:0?[13578]|1[02])(\/|-)31)|(?:(?:0?[1,3-9]|1[0-2])(\/|-)(?:29|30)))(\/|-)(?:[1-9]\d\d\d|\d[1-9]\d\d|\d\d[1-9]\d|\d\d\d[1-9])$|^((1[012]|0?[1-9]){1}\/(0?[1-9]|[12][0-9]|3[01]){1}\/\d{2,4}\s+(1[012]|0?[1-9]){1}:(0?[1-5]|[0-6][0-9]){1}:(0?[0-6]|[0-6][0-9]){1}\s+(am|pm|AM|PM){1})$/,
                    "alertText": "* التاريخ أو هيئة التاريخ غير صالحة",
                    "alertText2": "الهيئة المتوقعة: ",
                    "alertText3": "mm/dd/yyyy hh:mm:ss AM|PM أو ", 
                    "alertText4": "yyyy-mm-dd hh:mm:ss AM|PM"
	            }
            };
            
        }
    };

    $.validationEngineLanguage.newLang();
    
})(jQuery);
