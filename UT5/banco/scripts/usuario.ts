export default class Usuario{

    private _idCliente: string;
    private _nombreCliente: string;
    private _horaConexion: Date;

    constructor(idCliente: string, nombreCliente: string){
        this._idCliente = idCliente;
        this._nombreCliente= nombreCliente;
        this._horaConexion = new Date();
    }

    public get idCliente(): string{
        return this._idCliente;
    }

    public get nombreCliente(): string{
        return this._nombreCliente;
    }

    public get horaConexion(): Date{
        return this._horaConexion;
    }
}