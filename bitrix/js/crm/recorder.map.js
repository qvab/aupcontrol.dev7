{"version":3,"sources":["recorder.js"],"names":["micSvg","configMicrophone","stopMediaStream","mediaStream","MediaStream","getTracks","stop","forEach","track","events","unsupported","deviceReady","deviceListReady","deviceFailure","stateChanged","states","idle","failure","recording","paused","lastFrameDate","Date","getTime","BX","CrmRecorder","config","self","this","elements","main","element","container","canvas","callbacks","nop","state","microphones","defaultMicrophone","__getDefaultMicrophone","actualDeviceList","recorder","record","frequencyData","canvasContext","mic","image","Image","loaded","onload","src","URL","createObjectURL","Blob","type","init","prototype","start","isSupported","onCustomEvent","microphonesCount","navigator","mediaDevices","enumerateDevices","then","devices","device","kind","deviceId","label","getMediaStream","pause","__setState","resume","callback","isFunction","__createLayout","__bindEvents","width","height","getContext","imageSmoothingEnabled","mozImageSmoothingEnabled","webkitImageSmoothingEnabled","getUserMedia","__getConstraints","stream","replaceStream","Recorder","addCustomEvent","__onRecorderStopped","bind","attachAnalyser","Uint8Array","analyserNode","frequencyBinCount","window","requestAnimationFrame","__visualize","__updateDeviceList","catch","error","changeMicrophone","microphoneId","__setDefaultMicrophone","dispose","newState","event","oldState","create","props","className","children","appendChild","now","getByteFrequencyData","frequencyPoints","clearRect","beginPath","barWidth","barHeight","x","middlePoint","Math","ceil","drawImage","fillStyle","i","round","fillRect","closePath","localStorage","getItem","setItem","result","audio","video","browser","IsChrome","mandatory","sourceId","exact"],"mappings":"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","file":"recorder.map.js"}