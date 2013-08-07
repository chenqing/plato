#!/bin/bash
scp -r  application/models/*  root@chenqing.org:/data/plato/application/models/
scp -r  application/controllers/manage/*  root@chenqing.org:/data/plato/application/controllers/manage/
 scp -r  application/views/manage/*  root@chenqing.org:/data/plato/application/views/manage/
scp -r assets/ root@chenqing.org:/data/plato/assets/

