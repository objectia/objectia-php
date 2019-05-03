.PHONY: test

test:
	./vendor/bin/phpunit -v --configuration ./phpunit.xml.dist

test+cov:
	./vendor/bin/phpunit -v --configuration ./phpunit.xml.dist
	open ./build/coverage/index.html	

cov:
	open ./build/coverage/index.html	
