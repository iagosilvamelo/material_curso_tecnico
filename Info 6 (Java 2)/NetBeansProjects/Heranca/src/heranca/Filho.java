package heranca;

public class Filho extends Pai{
    
    public void poli(){
        System.out.println("Teste de Polimorfismo");
    }

    @Override
    public void contrato() {
        System.out.println("Contrato");
    }
    
}
