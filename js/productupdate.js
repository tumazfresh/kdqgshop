
function previewImage(input)
{
    var preview = document.getElementById('image-preview');
    var file = input.files[0];
    var reader = new FileReader();
    reader.onloadend = function ()
    {
        preview.src = reader.result;
    }
    if(file)
    {
        reader.readAsDataURL(file);
    }
    else
    {
        preview.src = "";
    }
}

function previewImageb(inputb)
{
    var previewb = document.getElementById('image-previewb');
    var fileb = inputb.files[0];
    var readerb = new FileReader();
    readerb.onloadend = function ()
    {
        previewb.src = readerb.result;
    }
    if(fileb)
    {
        readerb.readAsDataURL(fileb);
    }
    else
    {
        previewb.src = "";
    }
}

function previewImagec(inputc)
{
    var previewc = document.getElementById('image-previewc');
    var filec = inputc.files[0];
    var readerc = new FileReader();
    readerc.onloadend = function ()
    {
        previewc.src = readerc.result;
    }
    if(filec)
    {
        readerc.readAsDataURL(filec);
    }
    else
    {
        previewc.src = "";
    }
}
