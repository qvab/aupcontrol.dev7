{"version":3,"sources":["intranet.security.js"],"names":["BX","namespace","Intranet","UserProfile","Security","init","params","this","signedParameters","componentName","loader","container","userId","currentPage","showAuthComponent","showOtpConnectedComponent","showOtpComponent","showPasswordsComponent","showSynchronizeComponent","showSocnetEmailComponent","showRecoveryCodesComponent","showSocservComponent","otpNode","document","querySelector","type","isDomNode","bind","e","preventDefault","otpConnectedNode","passwordsNode","synchronizeNode","authNode","socnetEmailNode","socServNode","addCustomEvent","event","clearHtml","html","uiButtons","getElementsByClassName","remove","showLoader","node","size","ajax","runComponentAction","mode","data","then","result","showComponentData","showErrorPopup","message","hideLoader","componentMode","pageName","errors","prop","getArray","length","promise","Promise","delegate","resolve","reject","hasOwnProperty","assets","load","i","getString","pageTitle","getObject","top","history","pushState","Loader","target","show","hide","cleanNode","error","PopupWindowManager","create","id","content","props","style","closeIcon","lightShadow","offsetLeft","overlay","contentPadding"],"mappings":"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","file":"intranet.security.map.js"}