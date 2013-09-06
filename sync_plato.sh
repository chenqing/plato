#!/bin/bash
scp -r  plato.sql  root@chenqing.org:/data/plato/
scp -r  application/models/*  root@chenqing.org:/data/plato/application/models/
scp -r  application/controllers/manage/*  root@chenqing.org:/data/plato/application/controllers/manage/
 scp -r  application/views/*  root@chenqing.org:/data/plato/application/views/
scp -r assets/* root@chenqing.org:/data/plato/assets/

