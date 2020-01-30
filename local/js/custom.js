/**
 * Created by CLS010 on 20.01.2020.
 */
$(window).load(function() {

  $("body").append("<style> .link-onlyoffice {\
    position: absolute;\
	cursor: pointer;\
    left: 45px;\
    top: 7px;\
    background: url(/local/img/ico-edit.png) no-repeat center center;\
    width: 16px;\
    height: 17px;\
    background-size: contain;\
    opacity: 0.6;}\
	.link-onlyoffice:hover {\
		opacity: 1;\
	}</style>");

  $(".disk-folder-list-item-action").each(function() {
    $("<div title='Редактирвоание в OnlyOffice' class='link-onlyoffice'></div>")
      .insertAfter(this)
      .click(function() {
        var obParent = $(this).parents(".ui-grid-tile-item"),
          obJSON = JSON.parse(obParent.find(".disk-folder-list-item-title-link").attr("data-actions")),
          params = false;
        for (var inx in obJSON) {
          if (obJSON[inx].type === "edit") {
            params = {
              id: obJSON[inx].params.objectId,
              name: obJSON[inx].params.name
            };
          }
        }
        console.log(params);
      });
  });

});