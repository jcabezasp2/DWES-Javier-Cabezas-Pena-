export default class Usuario {
    constructor(idCliente, nombreCliente) {
        this._idCliente = idCliente;
        this._nombreCliente = nombreCliente;
        this._horaConexion = new Date();
    }
    get idCliente() {
        return this._idCliente;
    }
    get nombreCliente() {
        return this._nombreCliente;
    }
    get horaConexion() {
        return this._horaConexion;
    }
}
