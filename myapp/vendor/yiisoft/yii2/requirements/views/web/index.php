<?php
/* @var $this YiiRequirementChecker */
/* @var $summary array */
/* @var $requirements array[] */
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Yii Application Requirement Checker</title>
    <?php $this->renderViewFile(dirname(__FILE__) . '/css.php'); ?>
</head>
<body>
<div class="container">
    <header>
        <h1>Yii Application Requirement Checker</h1>
    </header>
    <hr>
    <main>
        <h3>Description</h3>
        <p>
        This script checks if your server configuration meets the requirements
        for running Yii application.
        It checks if the server is running the right version of PHP,
        if appropriate PHP extensions have been loaded, and if php.ini file settings are correct.
        </p>
        <p>
        There are two kinds of requirements being checked. Mandatory requirements are those that have to be met
        to allow Yii to work as expected. There are also some optional requirements being checked which will
        show you a warning when they do not meet. You can use Yii framework without them but some specific
        functionality may be not available in this case.
        </p>

        <h3>Conclusion</h3>
        <?php if ($summary['errors'] > 0): ?>
            <div class="alert alert-danger">
                <strong>Unfortunately your server configuration does not satisfy the requirements by this application.<br>Please refer to the table below for detailed explanation.</strong>
            </div>
        <?php elseif ($summary['warnings'] > 0): ?>
            <div class="alert alert-info">
                <strong>Your server configuration satisfies the minimum requirements by this application.<br>Please pay attention to the warnings listed below and check if your application will use the corresponding features.</strong>
            </div>
        <?php else: ?>
            <div class="alert alert-success">
                <strong>Congratulations! YUUU HUUUU Your server configuration satisfies all requirements.</strong>
            </div>
        <?php endif; ?>

        <h3>Details</h3>

        <table class="table table-bordered">
            <tr><th>Name</th><th>Result</th><th>Required By</th><th>Memo</th></tr>
            <?php foreach ($requirements as $requirement): ?>
            <tr class="<?php echo $requirement['condition'] ? 'success' : ($requirement['mandatory'] ? 'danger' : 'warning') ?>">
                <td>
                <?php echo $requirement['name'] ?>
                </td>
                <td>
                <span class="result"><?php echo $requirement['condition'] ? 'Passed' : ($requirement['mandatory'] ? 'Failed' : 'Warning') ?></span>
                </td>
                <td>
                <?php echo $requirement['by'] ?>
                </td>
                <td>
                <?php echo $requirement['memo'] ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </main>
    <hr>
    <footer>
        <p>Server: <?php echo $this->getServerInfo() . ' ' . $this->getNowDate() ?></p>
        <p>Powered by <a href="http://www.yiiframework.com/" rel="external">Yii Framework</a></p>
    </footer>
</div>
</body>
</html>
