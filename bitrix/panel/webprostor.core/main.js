function WebprostorCoreCheckActive(element_id = false, checkElements = false)
{
	var activeField = document.getElementById(element_id);
	if(activeField.checked)
		activeField.value = "Y";
	else
		activeField.value = "N";
	
	if(Array.isArray(checkElements) && checkElements.length > 0)
	{
		var checkElem;
		checkElements.forEach(function(element) {
			checkElem = document.getElementById(element);
			if(activeField.checked)
				checkElem.removeAttribute("disabled");
			else
				checkElem.setAttribute("disabled", "disabled")
		});
	}
}

function WebprostorCorePutString(str, element_id = false)
{
	var templateElement = document.getElementById(element_id);
	var templateElementValue = templateElement.value+str;
	templateElement.value = templateElementValue;
}

function WebprostorCoreReplaceString(str, element_id = false)
{
	var templateElement = document.getElementById(element_id);
	templateElement.value = str;
}

function WebprostorCoreRemoveRow(tableRowID)
{
	var tableRowRef = document.getElementById(tableRowID);
	tableRowRef.remove();
}

function WebprostorCoreGetNewRowId()
{
	return Math.floor(Math.random() * (999 - 0 + 1)) + 0;
}

function WebprostorCoreAddNewCellInput(rowDom, cellAlign, elementType, elementName, defaultValue = false, elementSize = false, elementMaxLength = false)
{
	var newCell = rowDom.insertCell(0);
	if(cellAlign)
		newCell.align = cellAlign;
	
	var newCellText = document.createElement('input');
	newCellText.className = "adm-input";
	if(elementType)
		newCellText.type = elementType;
	if(elementName)
		newCellText.name = elementName;
	if(defaultValue)
		newCellText.value = defaultValue;
	if(elementSize)
		newCellText.size = elementSize;
	if(elementMaxLength)
		newCellText.maxLength = elementMaxLength;
	newCell.appendChild(newCellText);
}

function WebprostorCoreAddNewCellText(rowDom, cellAlign, elementType, elemText = '')
{
	var newCell = rowDom.insertCell(0);
	if(cellAlign)
		newCell.align = cellAlign;
	
	var newCellText = document.createElement(elementType);
	newCellText.innerText = elemText;
	newCell.appendChild(newCellText);
}

function WebprostorCoreAddNewCellSelect(rowDom, cellAlign, elementName, selectValues = false, selectLabels = false)
{
	var newCell = rowDom.insertCell(0);
	if(cellAlign)
		newCell.align = cellAlign;
	
	var newCellText = document.createElement('select');
	if(elementName)
		newCellText.name = elementName;
	newCell.appendChild(newCellText);
	
	var i = 0;
	while(i < selectValues.length)
	{
		var option = document.createElement("option");
		if(i != 0)
			option.text = selectLabels[i]+' ['+selectValues[i]+']';
		else
			option.text = selectLabels[i];
		option.value = selectValues[i];
		newCellText.add(option);
		i++;
	}
}

function WebprostorCoreAddNewCellButton(rowDom, cellAlign, elementType, eventOnclick = false, addHtml = '')
{
	var newCell = rowDom.insertCell(0);
	if(cellAlign)
		newCell.align = cellAlign;
	
	var newCellText = document.createElement('button');
	if(elementType)
		newCellText.type = elementType;
	if(eventOnclick)
		newCellText.onclick = eventOnclick;
	if(addHtml)
		newCellText.innerHTML = addHtml;
	newCell.appendChild(newCellText);
}