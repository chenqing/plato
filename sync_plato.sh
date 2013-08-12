#!/bin/bash
scp -r  application/models/*  root@chenqing.org:/data/plato/application/models/
scp -r  application/libraries/*  root@chenqing.org:/data/plato/application/libraries/
scp -r  application/controllers/manage/*  root@chenqing.org:/data/plato/application/controllers/manage/
 scp -r  application/views/manage/*  root@chenqing.org:/data/plato/application/views/manage/
scp -r assets/js/* root@chenqing.org:/data/plato/assets/js/
scp -r assets/css/* root@chenqing.org:/data/plato/assets/css/

