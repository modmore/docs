var fs = require("fs"),
    path = require("path"),
    argv = require('optimist')
    		.default('path','assets/tpl/sources/scss/')
    		.default('ext','')
    		.default('outputStyle','compressed')
    		.default('outputDir','assets/tpl/dist/')
    		.default('browsers', "['> 2%', 'last 2 versions', 'ie >= 10', 'and_chr >= 2.3']")
    		.argv,
	antenne = require('./tools.js');


console.log('- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -');

var files = fs.readdirSync(argv.path);

files = files.filter(function (file) {
    return (file.charAt(0) !== '_');
    
}).map(function (file) {
    return path.join(argv.path, file);
    
}).filter(function (file) {
    return fs.statSync(file).isFile();
    
}).filter(function (file) {
    return (argv.ext == '' || path.extname(file) == '.'+argv.ext);
    
}).forEach(function (file) {

	if (path.extname(file) == '.js') {
		antenne.js({
			file: file,
		    outputDir: argv.outputDir
		});
	} else {
		antenne.sass({
			file: file,
		    outputDir: argv.outputDir,
		    outputStyle: argv.outputStyle,
		    browsers: argv.browsers
		});
	}

});
