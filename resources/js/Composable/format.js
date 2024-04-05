export const useItemFormat = (data) => {
    const result = {};

    result.name = data.name;
    result.inventory_id = data.inventory_id;
    result.description  = data.description;
    result.quantity = data.quantity;
    if(data.image) result.image = data.image;
    result._method = data._method;

    return result;
};