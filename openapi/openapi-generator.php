<?php

// OpenAPI Specification
$urlToOpenApiYaml = "../doc/api_spec.yaml";
// the generated code will be added to src/OpenApiBundle
$outputPath = "src/OpenApiBundle";// npm command to generate code from the spec
$output = shell_exec("node_modules/@openapitools/openapi-generator-cli generate -g php-symfony -i $urlToOpenApiYaml -o $outputPath -c openapi/config.json");
echo "$output";// remove some generated code to concentrate on the main parts
shell_exec("rm -rf $outputPath/Tests");
shell_exec("rm -rf $outputPath/src");

shell_exec("rm -rf $outputPath/.coveralls.yml");
shell_exec("rm -rf $outputPath/.gitignore");
shell_exec("rm -rf $outputPath/.openapi-generator-ignore");
shell_exec("rm -rf $outputPath/.php_cs.dist");
shell_exec("rm -rf $outputPath/.travis.yml");
shell_exec("rm -rf $outputPath/autoload.php");
shell_exec("rm -rf $outputPath/composer.json");
shell_exec("rm -rf $outputPath/git_push.sh");
shell_exec("rm -rf $outputPath/phpunit.xml.dist");
shell_exec("rm -rf $outputPath/pom.xml");
