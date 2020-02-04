var appOnlyOffice = function () {
  var self = this;
  var $ = jQuery;

  this.params = {
    file: {},
    user: {},
    frame: {}
  };

  this.loader = {
    init: function () {
      $("#only-office-loader").fadeIn(300);
    },
    destroy: function () {
      setTimeout(function () {
        $("#only-office-loader").fadeOut(300);
      }, 1500);
    }
  };

  /**
   * Добавляем кнопку дял открытия файла
   */
  this.renderMain = function () {
    $("body")
      .append("<link rel='stylesheet' type='text/css' href='/local/onlyoffice.css'>")
      .append("<div id='only-office-loader'></div>")
      .append('<div id="only-office-place"><div class="header"></div><div class="content"></div></div>');
    // Вещаем обработчик кликов
    this.onClickButton();
  };

  /**
   * Получаем параметры текущего пользвателя
   */
  this.getData = function () {
    BX.rest.callMethod('user.current', {}, function (res) {
      var user = res.data();
      BX.rest.callMethod("disk.file.get", {id: self.params.file.id}, function (res) {
        var file = res.data();
        self.params.frame = {
          user: {
            id: user.ID,
            name: user.NAME,
            email: user.EMAIL
          },
          file: {
            id: self.params.file.id,
            key: self.params.file.key,
            name: self.params.file.name,
            download: file.DOWNLOAD_URL
          },
          page: {
            title: 'Редактирование файла файла: ' + '"' + self.params.file.name + '"'
          }
        };
        // Открытие файла
        self.openFile();
      });
    });
  };

  this.openFile = function () {
    window.open("http://10.0.10.30/local/auth_bitrix.php?action=open_file&" + $.param(self.params.frame), "_blank");
  };


  this.onClickButton = function () {
    setInterval(function () {
      if ($(".link-onlyoffice").length < 1) {
        if ($(".main-grid-row.main-grid-row-body").length > 0) {
          // Для табличного вдиа
          $('.main-grid-row.main-grid-row-body[data-is-file="1"]').each(function () {
            var obj = $(this).find(".bx-disk-object-name td:eq(1)").css("position", "relative");
            $("<div title='Редактирвоание в OnlyOffice' class='type-table link-onlyoffice'></div>")
              .appendTo(obj)
              .click(function () {
                self.params.file = {
                  id: $(this).prev(".bx-disk-folder-title").attr('data-object-id'),
                  key: $(this).prev(".bx-disk-folder-title").attr('data-object-id'),
                  name: $(this).prev(".bx-disk-folder-title").attr('data-title'),
                };
                self.getData();
              });

          });
        }

        $(".disk-folder-list-item:not(.disk-folder-list-item-folder)").find(".disk-folder-list-item-action").each(function () {
          $("<div title='Редактирвоание в OnlyOffice' class='link-onlyoffice'></div>")
            .insertAfter(this)
            .click(function () {
              var obParent = $(this).parents(".ui-grid-tile-item");
              var obJSON = JSON.parse(obParent.find(".disk-folder-list-item-title-link").attr("data-actions"));
              for (var inx in obJSON) {
                if (obJSON[inx].type === "edit") {
                  self.params.file = {
                    id: obJSON[inx].params.objectId,
                    key: this.id,
                    name: obJSON[inx].params.name
                  };
                }
              }
              // Вызывем открытие файла
              self.getData();
            });
        });
      }
    }, 100);
  };


  /**
   * Инициализация приложения
   */
  this.init = function () {
    this.renderMain();
  };
};


$(window).load(function () {
  var obOnlyOffice = new appOnlyOffice;
  obOnlyOffice.init();
});
