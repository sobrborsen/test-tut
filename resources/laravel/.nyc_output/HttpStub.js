
/**
 * This is a stub for Http to make the client testable.
 * By setting the jsonFixture you can simulate the remote reponse.
 */
export const StubHandler = {
    url: null,
    _response: [],

    push: function (data) {
        this._response.push(data);    
    },

    pop: function () {
        if (this.isEmpty()) {
            throw Error('Can not pop on empty response queue');
        }
        return this._response.shift();
    },

    isEmpty: function () {
        return this._response.length == 0;    
    },

    reset: function() {
        this.url = null;
        this._response = [];
    },

    get: function (target, method, argumentList) {
        return this.run.bind(this);
    },

    run: function (url, params, data) {
        this.url = url;
        return new Promise((resolve, reject) => {
            let response = this.pop();
            if (response.error) {
                reject(response.error);
            }
            else {
                resolve(response);
            }
        });
    }
};

export const HttpStub = new Proxy({}, StubHandler);

