package model;

public class Imovel implements mvc.Model{
    private String imovel, endereco, numero, tipo;

    public String getImovel() {
        return imovel;
    }

    public void setImovel(String imovel) {
        this.imovel = imovel;
    }

    public String getEndereco() {
        return endereco;
    }

    public void setEndereco(String endereco) {
        this.endereco = endereco;
    }

    public String getNumero() {
        return numero;
    }

    public void setNumero(String numero) {
        this.numero = numero;
    }

    public String getTipo() {
        return tipo;
    }

    public void setTipo(String tipo) {
        this.tipo = tipo;
    }

    public Imovel(String imovel, String endereco, String numero, String tipo) {
        this.imovel = imovel;
        this.endereco = endereco;
        this.numero = numero;
        this.tipo = tipo;
    }
    
}
