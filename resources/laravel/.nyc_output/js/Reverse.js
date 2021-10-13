
export const Reverse = {
    data() {
        return {
            text: '',
            reversed: '',
            error: '',
        }
    },

    methods: {
        next(event) {
            event.preventDefault();
            this.reversed = '';
            this.error = '';
            if (this.text.trim().length <= 0) {
                this.error = 'Input is required';
                return;
            }
            this.http.get(this.text).then(reversed => {
                this.reversed = reversed;
            }).catch(error => {
                this.error = error;
            });
        }
    },

    template: `
        <h1>Reverse</h1>
        <form method="get" action='/reverse'>
            <label>Indtast et tekst </label>
            <input id="input" v-model="text" >
            <button id="button" @click="next" type="submit">Reverse</button>
        </form>

        <p v-if="error" style="color:red">Error: {{ error }}</p>

        <p id="reverse" v-if="reversed">Reversed: {{ reversed }}</p>
    `
};


