{"version":3,"sources":["logic.js"],"names":["BX","namespace","Tasks","Component","TasksWidgetMemberSelector","extend","sys","code","types","methodsStatic","instances","getInstance","name","addInstance","obj","methods","construct","this","callConstruct","id","getSelector","option","bindEvent","onChanged","bind","self","Event","EventEmitter","subscribe","data","onSelectorItemSelected","items","value","get","control","subInstance","options","scope","hidePreviousIfSingleAndRequired","max","min","nameTemplate","path","preRendered","popupOffsetTop","popupOffsetLeft","readOnly","parent","mode","USER","useAdd","mail","selector","constructor","ItemManager","ProxyChangeEvent","fireEvent","arguments","count","export","exportItemData","replaceItem","replaceAll","unload","itemFx","checkRestrictions","load","flag","readonly","UserItemSet","controlBind","itemFxHoverDelete","prefixId","onSearchBlurred","emailUserPopup","style","display","callMethod","vars","constraint","restoreKept","changed","extractItemValue","hasItem","addItem","toDelete","checkCanAddItems","close","resetInput","openAddForm","forceDeleteFirst","onItemDeleteByCross","first","getItemFirst","deleteItem","call"],"mappings":"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","file":"logic.map.js"}