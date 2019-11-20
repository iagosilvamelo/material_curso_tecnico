package model;

public class Funcionario implements mvc.Model{
    private String nome, setor, andar, sala, cargo;

    public Funcionario(String nome, String setor, String andar, String sala, String cargo) {
        this.nome = nome;
        this.setor = setor;
        this.andar = andar;
        this.sala = sala;
        this.cargo = cargo;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getSetor() {
        return setor;
    }

    public void setSetor(String setor) {
        this.setor = setor;
    }

    public String getAndar() {
        return andar;
    }

    public void setAndar(String andar) {
        this.andar = andar;
    }

    public String getSala() {
        return sala;
    }

    public void setSala(String sala) {
        this.sala = sala;
    }

    public String getCargo() {
        return cargo;
    }

    public void setCargo(String cargo) {
        this.cargo = cargo;
    }
    
}
