// The funky width is for iPhone. And this whole script is for
// backward-compatibility: we deployed it and now we're stuck with it :).
var scripts = document.getElementsByTagName('script'),
    script = scripts[scripts.length - 1],
    src = script.getAttribute('src'),
    hash_m = src.match(/(#!.*)/),
    hash = hash_m ? hash_m[1] : '';

document.write('<iframe src="http://104.236.211.149/ods/compara.html#grafica' + hash + '" width="600" height="500" scrolling="no" frameborder="0" style="width=1px;min-width:100%;max-width:100%"></iframe>');
