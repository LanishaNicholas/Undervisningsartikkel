<?php

 $question = [
                    'question' => 'Hva er den primære betydningen av klovneriet i Svalbards historie og kultur?',
                    'options' => [
                                    ['text' => 'Klovner ble introdusert som en form for underholdning for å bryte opp monotonien i det isolerte arktiske livet.',
                                        'correct' => false
                                    ],
                                    ['text' => 'Klovneriet har fungert som et kulturelt bindeledd mellom folk fra forskjellige nasjonaliteter og bakgrunner på Svalbard.',
                                        'correct' => false
                                    ],
                                    ['text' => 'Klovner i Svalbard er engasjert i ulike sosiale og miljømessige initiativer.',
                                        'correct' => false
                                    ],
                                    ['text' => 'Klovneriet i Svalbard er et levende og mangfoldig kulturelt fenomen som har en lang historie og en dyp betydning for øygruppens innbyggere.',
                                      'correct' => false
                                    ]
                                ]
                ];

    echo json_encode( $question); die;