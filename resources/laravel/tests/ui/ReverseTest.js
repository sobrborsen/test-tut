import * as Vue from '/js/lib/vue.esm-browser.js';
import { Reverse } from '/js/Reverse.js';
import { HttpStub, StubHandler } from './HttpStub.js';
import { Sleep } from './Sleep.js';

QUnit.module('Reverse', {
    beforeEach: async function () {
        const app = Vue.createApp(Reverse);
        app.config.globalProperties.http = HttpStub;
        app.mount('#app');

        StubHandler.reset();
    }
});

QUnit.test('Is mounted', async function (assert) {
    let el = document.getElementById('app');
    assert.ok(el != null);
    assert.equal(el.children.length, 2);
});

QUnit.test('Reverse', async function (assert) {
    StubHandler.push('asjeH');

    let el = document.getElementById('input');
    assert.ok(el != null);
    el.value = 'Hejsa';
    el.dispatchEvent(new Event('input'));

    el = document.getElementById('button');
    assert.ok(el != null);
    el.click();

    await Sleep.for(1);

    el = document.getElementById('reverse');
    assert.ok(el != null);
    assert.ok(el.textContent.endsWith('asjeH'))
});

QUnit.test('Empty input', async function (assert) {
    //TODO implement test case for empty input
    assert.equal(false);
});

QUnit.test('Error', async function (assert) {
    //TODO implement test case for an server error
    assert.equal(false);
});
