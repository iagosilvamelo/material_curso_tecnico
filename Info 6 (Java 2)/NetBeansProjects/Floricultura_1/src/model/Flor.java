package model;

public class Flor implements Modelagem {
    String flor, tipoFlor;
    int valor;

    public Flor(String flor, String tipoFlor, int valor) {
        this.flor = flor;
        this.tipoFlor = tipoFlor;
        this.valor = valor;
    }

    public String getFlor() {
        return flor;
    }

    public void setFlor(String flor) {
        this.flor = flor;
    }

    public String getTipoFlor() {
        return tipoFlor;
    }

    public void setTipoFlor(String tipoFlor) {
        this.tipoFlor = tipoFlor;
    }

    public int getValor() {
        return valor;
    }

    public void setValor(int valor) {
        this.valor = valor;
    }
    
    
}
