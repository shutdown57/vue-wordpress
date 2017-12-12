
export const addArray = (el) => {
    let arr = [];
    arr.push(el);
    return arr;
};

export const removeArray = (arr, el) => {
    let index = arr.indexOf(el);
    if ( index != -1 ) {
        arr.splice(index, 1);
    }
};