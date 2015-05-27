
test:
	phpunit --colors test/

test-caliper:
	phpunit --debug --colors test/caliper/


.PHONY: test
