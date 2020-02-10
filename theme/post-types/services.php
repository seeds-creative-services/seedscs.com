<?php

return array(

    "name" => array(

        "singular" => "Service",

        "multiple" => "Services"

    ),

    "slug" => "services",

    "icon" => "f562",

    "glance" => true,

    "gutenberg" => true,

    "public" => true,

    "show" => array(

        "menu" => true,

        "ui" => true

    ),

    "supports" => array(

        "title", "thumbnail"

    ),

    "taxonomies" => array(

        "abilities" => array(

            "name" => array(

                "singular" => "Ability",

                "multiple" => "Abilities"

            ),

            "public" => true,

            "show" => array(

                "menu" => true,

                "ui" => true

            ),

            "supports" => array(

                "title", "thumbnail"

            ),

        )

    )

);