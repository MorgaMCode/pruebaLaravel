import { localize } from '@vee-validate/i18n';
import es from '@vee-validate/i18n/dist/locale/es.json';
import rules from '@vee-validate/rules';
import { configure, defineRule } from 'vee-validate';

Object.entries(rules).forEach(([key, value]) => {
	defineRule(key, value);
});

localize({ es });

configure({
	generateMessage: localize('es'),
});