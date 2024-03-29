BX.namespace("BX.Crm");
if(typeof BX.Crm.PartialEditorDialog === "undefined")
{
	BX.Crm.PartialEditorDialog = function()
	{
		this._id = "";
		this._settings = {};

		this._serviceUrl = "";
		this._entityTypeId = 0;
		this._entityTypeName = "";
		this._entityId = 0;
		this._fieldNames = null;
		this._html = null;

		this._editor = null;
		this._wrapper = null;
		this._popup = null;
		this._buttons = null;

		this._isLocked = false;

		this._entityUpdateSuccessHandler = BX.delegate(this.onEntityUpdateSuccess, this);
		this._entityUpdateFailureHandler = BX.delegate(this.onEntityUpdateFailure, this);
		this._entityValidationFailureHandler = BX.delegate(this.onEntityValidationFailure, this);

	};
	BX.Crm.PartialEditorDialog.prototype =
	{
		initialize: function(id, settings)
		{
			this._id = BX.type.isNotEmptyString(id) ? id : BX.util.getRandomString(4);
			this._settings = settings ? settings : {};

			this._entityTypeId = BX.prop.getInteger(this._settings, "entityTypeId", 0);
			if(this._entityTypeId !== BX.CrmEntityType.enumeration.undefined)
			{
				this._entityTypeName = BX.CrmEntityType.resolveName(this._entityTypeId);
			}
			else
			{
				this._entityTypeName = BX.prop.getString(this._settings, "entityTypeName", "");
				this._entityTypeId = BX.CrmEntityType.resolveId(this._entityTypeName);
			}

			this._entityId = BX.prop.getInteger(this._settings, "entityId", 0);
			this._fieldNames = BX.prop.getArray(this._settings, "fieldNames", []);

			this._isAccepted = false;
		},
		getSetting: function(name, defaultValue)
		{
			return BX.prop.get(this._settings, name, defaultValue);
		},
		getId: function()
		{
			return this._id;
		},
		getEditorId: function()
		{
			//return this._editorId;
			return this._entityTypeName.toLowerCase() + "_" + this._entityId + "_partial_editor";
		},
		isLoaded: function()
		{
			return this._html !== null;
		},
		getServiceUrl: function()
		{
			return BX.prop.getString(BX.Crm.PartialEditorDialog.entityEditorUrls, this._entityTypeName, "");
		},
		load: function()
		{
			BX.ajax.post(
				this.getServiceUrl(),
				{
					ACTION: "PREPARE_EDITOR_HTML",
					ACTION_ENTITY_TYPE_NAME: this._entityTypeName,
					ACTION_ENTITY_ID: this._entityId,
					GUID: this.getEditorId(),
					FIELDS: this._fieldNames,
					PARAMS: {},
					CONTEXT: BX.prop.getObject(this._settings, "context", {}),
					TITLE: BX.prop.getString(this._settings, "title", "No title"),
					FORCE_DEFAULT_CONFIG: "Y",
					ENABLE_CONFIG_SCOPE_TOGGLE: "N",
					ENABLE_CONFIGURATION_UPDATE: "N",
					ENABLE_FIELDS_CONTEXT_MENU: "N",
					IS_EMBEDDED: "Y"
				},
				function(result)
				{
					if(typeof(BX.Crm.EntityEditor) !== "undefined")
					{
						var editor = BX.Crm.EntityEditor.get(this.getEditorId());
						if(editor)
						{
							editor.release();
						}
					}

					this._html = result;
					this.innerOpen();
				}.bind(this)
			);
		},
		open: function()
		{
			if(!this.isLoaded())
			{
				this.load();
			}
			else
			{
				this.innerOpen();
			}
		},
		innerOpen: function()
		{
			if(!this.isLoaded())
			{
				return;
			}

			this._popup = new BX.PopupWindow(
				this._id,
				null,
				{
					autoHide: false,
					draggable: false,
					closeByEsc: true,
					offsetLeft: 0,
					offsetTop: 0,
					zIndex: BX.prop.getInteger(this._settings, "zIndex", 0),
					bindOptions: { forceBindPosition: true },
					content: this.prepareContent(),
					events:
						{
							onPopupShow: BX.delegate(this.onPopupShow, this),
							onPopupClose: BX.delegate(this.onPopupClose, this),
							onPopupDestroy: BX.delegate(this.onPopupDestroy, this)
						}
				}
			);
			this._popup.show();
			this._isAccepted = false;
		},
		close: function()
		{
			if(this._popup)
			{
				this._popup.close();
			}
		},
		isOpen: function()
		{
			return this._popup && this._popup.isShown();
		},
		prepareContent: function()
		{
			this._wrapper = BX.create("div",
				{
					props: { id: this._id + "_wrapper"/*, className: "crm-entity-popup-fill-required-fields"*/ },
					style: { width: "500px" }
				}
			);
			this._wrapper.innerHTML = this._html;

			var buttonWrapper = BX.create("div",
				{
					props: { className: "crm-entity-popup-fill-required-fields-btns" }
				}
			);
			this._wrapper.appendChild(buttonWrapper);

			this._buttons = {};
			this._buttons[BX.Crm.DialogButtonType.names.accept] = BX.create(
				"span",
				{
					props: { className: "ui-btn ui-btn-primary" },
					text: BX.message("JS_CORE_WINDOW_SAVE"),
					events: {  click: BX.delegate(this.onSaveButtonClick, this) }
				}
			);
			this._buttons[BX.Crm.DialogButtonType.names.cancel] = BX.create(
				"span",
				{
					props: { className: "ui-btn ui-btn-link" },
					text: BX.message("JS_CORE_WINDOW_CANCEL"),
					events: {  click: BX.delegate(this.onCancelButtonClick, this) }
				}
			);

			buttonWrapper.appendChild(this._buttons[BX.Crm.DialogButtonType.names.accept]);
			buttonWrapper.appendChild(this._buttons[BX.Crm.DialogButtonType.names.cancel]);

			return this._wrapper;
		},
		onSaveButtonClick: function(e)
		{
			if(this._isLocked)
			{
				return;
			}
			this._isLocked = true;
			this._isAccepted = true;

			if(!this._editor)
			{
				return;
			}

			BX.addClass(this._buttons[BX.Crm.DialogButtonType.names.accept], "ui-btn-clock");

			BX.addCustomEvent(window, "onCrmEntityUpdate", this._entityUpdateSuccessHandler);
			BX.addCustomEvent(window, "onCrmEntityUpdateError", this._entityUpdateFailureHandler);
			BX.addCustomEvent(window, "BX.Crm.EntityEditor:onFailedValidation", this._entityValidationFailureHandler);

			this._editor.save();
		},
		onCancelButtonClick: function(e)
		{
			if(this._isLocked)
			{
				return;
			}
			this._isLocked = true;
			this._isAccepted = false;

			if(this._popup)
			{
				this._popup.close();
			}
		},
		onEntityUpdateSuccess: function(eventParams)
		{
			if(this._entityTypeId === BX.prop.getInteger(eventParams, "entityTypeId", 0)
				&& this._entityId === BX.prop.getInteger(eventParams, "entityId", 0)
			)
			{
				this._isLocked = false;

				BX.removeClass(this._buttons[BX.Crm.DialogButtonType.names.accept], "ui-btn-clock");

				BX.removeCustomEvent(window, "onCrmEntityUpdate", this._entityUpdateSuccessHandler);
				BX.removeCustomEvent(window, "onCrmEntityUpdateError", this._entityUpdateFailureHandler);
				BX.removeCustomEvent(window, "BX.Crm.EntityEditor:onFailedValidation", this._entityValidationFailureHandler);

				if(this._popup)
				{
					this._popup.close();
				}

				BX.onCustomEvent(
					window,
					"Crm.PartialEditorDialog.Close",
					[
						this,
						{
							entityTypeId: this._entityTypeId,
							entityTypeName: BX.CrmEntityType.resolveName(this._entityTypeId),
							entityId: this._entityId,
							entityData: BX.prop.getObject(eventParams, "entityData", null),
							bid: BX.Crm.DialogButtonType.accept,
							isCancelled: false
						}
					]
				);
			}
		},
		onEntityUpdateFailure: function(eventParams)
		{
			if(this._entityTypeId === BX.prop.getInteger(eventParams, "entityTypeId", 0)
				&& this._entityId === BX.prop.getInteger(eventParams, "entityId", 0)
			)
			{
				this._isLocked = false;

				BX.removeClass(this._buttons[BX.Crm.DialogButtonType.names.accept], "ui-btn-clock");

				BX.removeCustomEvent(window, "onCrmEntityUpdate", this._entityUpdateSuccessHandler);
				BX.removeCustomEvent(window, "onCrmEntityUpdateError", this._entityUpdateFailureHandler);
				BX.removeCustomEvent(window, "BX.Crm.EntityEditor:onFailedValidation", this._entityValidationFailureHandler);
			}
		},
		onEntityValidationFailure: function(sender, eventArgs)
		{
			if(this._editor !== sender)
			{
				return;
			}

			this._isLocked = false;

			BX.removeClass(this._buttons[BX.Crm.DialogButtonType.names.accept], "ui-btn-clock");

			BX.removeCustomEvent(window, "onCrmEntityUpdate", this._entityUpdateSuccessHandler);
			BX.removeCustomEvent(window, "onCrmEntityUpdateError", this._entityUpdateFailureHandler);
			BX.removeCustomEvent(window, "BX.Crm.EntityEditor:onFailedValidation", this._entityValidationFailureHandler);
		},
		onPopupShow: function()
		{
			BX.addCustomEvent(
				window,
				"BX.Crm.EntityEditor:onInit",
				function(sender, eventArgs)
				{
					if(sender.getId() !== this.getEditorId())
					{
						return;
					}

					this._editor = sender;

					var helpData = BX.prop.getObject(this._settings, "helpData", null);
					if(helpData)
					{
						this._editor.addHelpLink(helpData);
					}
				}.bind(this)
			);

			window.setTimeout(function() { if(this._popup) this._popup.adjustPosition(); }.bind(this), 150);
		},
		onPopupClose: function()
		{
			if(this._editor)
			{
				this._editor.release();
			}

			if(!this._isAccepted)
			{
				BX.onCustomEvent(
					window,
					"Crm.PartialEditorDialog.Close",
					[
						this,
						{
							entityTypeId: this._entityTypeId,
							entityTypeName: BX.CrmEntityType.resolveName(this._entityTypeId),
							entityId: this._entityId,
							bid: BX.Crm.DialogButtonType.cancel,
							isCancelled: true
						}
					]
				);
			}

			if(this._popup)
			{
				this._popup.destroy();
			}
		},
		onPopupDestroy: function()
		{
			if(this._popup)
			{
				this._popup = null;
			}
			delete BX.Crm.PartialEditorDialog.items[this.getId()];
		}
	};
	if(typeof(BX.Crm.PartialEditorDialog.entityEditorUrls) === "undefined")
	{
		BX.Crm.PartialEditorDialog.entityEditorUrls = {};
	}
	BX.Crm.PartialEditorDialog.registerEntityEditorUrl = function(entityTypeName, url)
	{
		BX.Crm.PartialEditorDialog.entityEditorUrls[entityTypeName] = url;
	};
	BX.Crm.PartialEditorDialog.items = {};
	BX.Crm.PartialEditorDialog.hasOpenItems = function()
	{
		for(var key in this.items)
		{
			if(!this.items.hasOwnProperty(key))
			{
				continue;
			}

			if(this.items[key].isOpen())
			{
				return true;
			}
		}
		return false;
	};
	BX.Crm.PartialEditorDialog.getItem = function(id)
	{
		return this.items.hasOwnProperty(id) ? this.items[id] : null;
	};
	BX.Crm.PartialEditorDialog.close = function(id)
	{
		if(this.items.hasOwnProperty(id))
		{
			this.items[id].close();
		}
	};
	BX.Crm.PartialEditorDialog.create = function(id, settings)
	{
		var self = new BX.Crm.PartialEditorDialog();
		self.initialize(id, settings);
		this.items[self.getId()] = self;
		return self;
	};
}