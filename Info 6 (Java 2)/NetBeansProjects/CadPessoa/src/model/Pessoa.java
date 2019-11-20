package model;

public class Pessoa implements mvc.Model{
    private String nome, rg, sexo;

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getRg() {
        return rg;
    }

    public void setRg(String rg) {
        this.rg = rg;
    }

    public String getSexo() {
        return sexo;
    }

    public void setSexo(String sexo) {
        this.sexo = sexo;
    }

    public Pessoa(String nome, String rg, String sexo) {
        this.nome = nome;
        this.rg = rg;
        this.sexo = sexo;
    }
}
