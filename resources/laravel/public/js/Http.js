
export class Http {

    async get(text) {
        const data = {
            text: text,
            json: 1
        };
        const args = new URLSearchParams(data);
        const url = '/reverse?' + args.toString();
        const resp = await fetch(url);

        let result = 'Ups!';
        if (resp.ok) {
            const data = await resp.json();
            if (data.errors) {
                throw data.errors.text[0];
            }
            result = data.reversed;
        }
        return result;
    }
}
