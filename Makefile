.PHONY: deploy redeploy test serve seed health backup

deploy:
	bash deploy.sh

redeploy:
	bash redeploy.sh

test:
	bash runtest.sh

serve:
	php artisan serve --host=127.0.0.1 --port=8000

seed:
	bash seed.sh

health:
	bash healthcheck.sh

backup:
	bash backup.sh
