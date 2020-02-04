<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?=$_GET["page"]["title"]?></title>
</head>
<body>
<div id="placeholder" style="height: 100%; width: 100%;"></div>
<script type="text/javascript" src="http://10.0.10.30:8080/web-apps/apps/api/documents/api.js"></script>
<script>
    var config = {
        "document": {
            "fileType": "<?=$_GET["file"]["type"]?>",
            "key": "<?=$_GET["file"]["key"]?>",
            "title": "<?=$_GET["file"]["name"]?>",
            "url": "https://aupcontrol.ru/rest/download.json?auth=eee6375e0043961200439610000000b8100e03ec3cb71d70a6534917ef37bdbfbfda28&access_token=eee6375e0043961200439610000000b8100e03ec3cb71d70a6534917ef37bdbfbfda28&token=disk%7CaWQ9MTIxNjcmXz1iaG0xYkl2WmsyTUVjOFdOUzRuMkF3RHU3c2pIOGN1bA%3D%3D%7CImRvd25sb2FkfGRpc2t8YVdROU1USXhOamNtWHoxaWFHMHhZa2wyV21zeVRVVmpPRmRPVXpSdU1rRjNSSFUzYzJwSU9HTjFiQT09fGVlZTYzNzVlMDA0Mzk2MTIwMDQzOTYxMDAwMDAwMGI4MTAwZTAzZWMzY2I3MWQ3MGE2NTM0OTE3ZWYzN2JkYmZiZmRhMjh8ZWVlNjM3NWUwMDQzOTYxMjAwNDM5NjEwMDAwMDAwYjgxMDBlMDNlYzNjYjcxZDcwYTY1MzQ5MTdlZjM3YmRiZmJmZGEyOCI%3D.IJU%2BljJ3E9VIcp2i%2FObLNQIYoo585IaCi3J0YdqRgkI%3D",
            "mode": "edit",
            "permissions": {
                "comment": true,
                "download": true,
                "edit": true,
                "fillForms": true,
                "print": true,
                "review": true
            }
        },
        "documentType": "text",
        editorConfig: {
            mode: 'edit',
            lang: "ru",
            callbackUrl: "http://10.0.10.30:8080/webeditor-ajax.php?type=track&fileName=<?=$_GET["file"]["name"]?>&userAddress=192.168.0.37",
            embedded: {
                saveUrl: "http://10.0.10.30:8080/Storage/<?=$_GET["file"]["name"]?>",
                embedUrl: "http://10.0.10.30:8080/Storage/<?=$_GET["file"]["name"]?>",
                shareUrl: "http://10.0.10.30:8080/Storage/<?=$_GET["file"]["name"]?>",
                toolbarDocked: "top",
            },
            customization: {
                about: true,
                feedback: true,
                goback: {
                    url: "http://10.0.10.30:8080"
                }
            }
        }
    };
    var docEditor = new DocsAPI.DocEditor("placeholder", config);
</script>
</body>
</html>