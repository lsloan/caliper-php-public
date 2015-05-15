<?php

interface Assignable {
    public function getDateToStartOn();

    public function getDateToActivate();

    public function getDateToShow();

    public function getDateToSubmit();

    public function getMaxAttempts();

    public function getMaxSubmits();
}