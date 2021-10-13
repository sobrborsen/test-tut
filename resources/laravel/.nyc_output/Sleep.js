
/**
 * This is async wait so that you can async and await statements
 */
export const Sleep = {
    /**
     * Number of milliseconds to wait
     * @param {int} time 
     */
    for: function (time = 10) {
        return new Promise((resolve, reject) => {
            setTimeout(resolve, time);
        });
    }
};
