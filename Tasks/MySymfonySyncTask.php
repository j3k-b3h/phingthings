<?php

require_once "phing/Task.php";

/**
 * Phing-Task zum Synchronisieren einer Symfony-Anwendung per FTP
 *
 * @author Jacek Blech <j3k.b3h@gmail.com>
 * @version 0.2
 */
class MySymfonySyncTask extends Task {
    private $host;
    private $username;
    private $password;
    private $targetfolder;
    private $sourcefolder;

    public function setHost($str) {
        $this->host = $str;
    }
    public function setUsername($str) {
        $this->username = $str;
    }
    public function setPassword($str) {
        $this->password = $str;
    }
    public function setTargetfolder($str) {
        $this->targetfolder = $str;
    }
    public function setSourcefolder($str) {
        $this->sourcefolder = $str;
    }

    /**
     * The init method: Do init steps.
     */
    public function init() {
        // nothing to do here
    }

    /**
     * The main entry point method.
     */
    public function main() {

        $cmd = sprintf(
            'lftp -f "
    open %s
        user %s %s
        lcd %s
        mirror \
            --reverse \
            --delete \
            --verbose \
            --use-cache \
            --exclude=.git* \
            --exclude=app/config/parameters.yml \
            --exclude=var/cache \
            --exclude=var/logs \
            --exclude=app/cache \
            --exclude=app/logs \
            --exclude=vendor \
            --exclude=composer.lock \
            --exclude=build.xml \
            --exclude=apigen.neon \
            %s %s
bye
"',
            $this->host,
            $this->username,
            $this->password,
            $this->sourcefolder,
            $this->sourcefolder,
            $this->targetfolder
        );
        #print $cmd;
        $output = null;
        $return_var = null;
        #exec($cmd, $output, $return_var);
        #shell_exec($cmd);
        print "\nFühre mirror per lftp durch...\n";
        passthru($cmd, $return_var);
        print "\nAufruf lieferte folgenden Rückgabestatus: $return_var\n";
    }
}