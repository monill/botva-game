<?php

class InitVars
{
        # ������������ ����� � ��������
        var $deny_words = array("union", "char", "select", "update", "group", "order", "benchmark");

        function InitVars()
        {
        }

        # ����� ������������ ��������������� ������� $_POST, $_GET � ���������
        # �������� : $_GET['psw'] ����� �������������� � $psw � ��� �� ���������
        function convertArray2Vars()
        {
                foreach ($_GET as $_ind => $_val) {
                        global $$_ind;
                        if (is_array($$_ind)) $$_ind = htmlspecialchars(stripslashes($_val));
                }

                foreach ($_POST as $_ind => $_val) {
                        global $$_ind;
                        if (is_array($$_ind)) $$_ind = htmlspecialchars(stripslashes($_val));
                }
        }

        # ����� ��������� $_GET � $_POST ���������� �� ������� ������� ������ � SQL ��������
        function checkVars()
        {
                //�������� ������� ������.
                foreach ($_GET as $_ind => $_val) {
                        $_GET[$_ind] = htmlspecialchars(stripslashes($_val));

                        $exp = explode(" ", $_GET[$_ind]);
                        foreach ($exp as $ind => $val) {
                                if (in_array($val, $this->deny_words)) $this->antihack("����������, ��� ��������� ��� �������... ������������������� ������ � �� �������� �������� ������� �� ���� �� 3-� �� 5-�� ���. <br> ��� ip ������ �������. ��� ���� �� ����� ��������, ������?. ");
                        }
                }

                foreach ($_POST as $_ind => $_val) {
                        $_POST[$_ind] = htmlspecialchars(stripslashes($_val));

                        $exp = explode(" ", $_POST[$_ind]);
                        foreach ($exp as $ind => $val) {
                                if (in_array($val, $this->deny_words)) $this->antihack("����������, ��� ��������� ��� �������... ������������������� ������ � �� �������� �������� ������� �� ���� �� 3-� �� 5-�� ���. <br> ��� ip ������ �������. ��� ���� �� ����� ��������, ������?.");
                        }
                }
        }

        function antihack($msg)
        {
                echo "<font color='red'><b>Antihack error: </b></font>$msg<br>\n";
                die;
        }
}
