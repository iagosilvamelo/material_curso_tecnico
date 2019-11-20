package model;

public class Peca implements mvc.Model{
    private String peca, tipo, qtd;

    public Peca(String peca, String tipo, String qtd) {
        this.peca = peca;
        this.tipo = tipo;
        this.qtd = qtd;
    }

    public String getPeca() {
        return peca;
    }

    public void setPeca(String peca) {
        this.peca = peca;
    }

    public String getTipo() {
        return tipo;
    }

    public void setTipo(String tipo) {
        this.tipo = tipo;
    }

    public String getQtd() {
        return qtd;
    }

    public void setQtd(String qtd) {
        this.qtd = qtd;
    }
    
}
